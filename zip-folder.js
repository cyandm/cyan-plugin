const fs = require('fs');
const path = require('path');
const archiver = require('archiver');

const folderToZip = '.'; // مسیر پوشه مورد نظر
const outputZipFile = './output.zip'; // نام فایل خروجی zip

const output = fs.createWriteStream(outputZipFile);
const archive = archiver('zip', { zlib: { level: 9 } });

const exceptFolders = [
	'.git',
	'node_modules',
	'vendor',
	'.gitignore',
	'composer.json',
	'composer.lock',
	'package.json',
	'package-lock.json',
	'zip-folder.js',
	'output.zip',
];

// محاسبه و نمایش درصد پیشرفت
let totalFiles = 0;
let processedFiles = 0;

async function countFiles(dir) {
	const files = await fs.promises.readdir(dir);
	for (const file of files) {
		const filePath = path.join(dir, file);
		const stat = await fs.promises.stat(filePath);
		if (stat.isDirectory()) {
			await countFiles(filePath); // شمارش فایل‌های داخل دایرکتوری
		} else {
			totalFiles++;
		}
	}
}

archive.on('progress', function (data) {
	const percent = ((processedFiles / totalFiles) * 100).toFixed(2);
	console.log(`progress: ${percent}%`);
});

output.on('close', function () {
	console.log(`${archive.pointer()} total bytes`);
	console.log('successful!');
});

archive.on('error', function (err) {
	throw err;
});

archive.pipe(output);

// تابع برای اضافه کردن فایل‌ها به آرشیو
async function addFilesToArchive(dir) {
	const files = await fs.promises.readdir(dir);

	for (const file of files) {
		if (exceptFolders.includes(file)) {
			continue;
		}

		const filePath = path.join(dir, file);
		const relativePath = path.relative(folderToZip, filePath); // مسیر نسبی برای آرشیو

		const stat = await fs.promises.stat(filePath);

		if (stat.isDirectory()) {
			// اگر دایرکتوری است، به آرشیو اضافه کنید و به داخل آن بروید
			archive.directory(filePath + '/', relativePath + '/');
			await addFilesToArchive(filePath); // پیمایش دایرکتوری‌های زیرین
		} else {
			archive.file(filePath, { name: relativePath });
		}
	}
}

(async () => {
	await addFilesToArchive(folderToZip);
	archive.finalize();
})();
