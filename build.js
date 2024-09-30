const esbuild = require('esbuild');

esbuild
	.build({
		entryPoints: ['./assets/js/script.js'], // فایل ورودی
		bundle: true, // بسته‌بندی
		outfile: './assets/js/bundle.js', // فایل خروجی
		minify: true, // بهینه‌سازی
		sourcemap: true, // نقشه‌های منبع
		watch: process.argv.includes('--watch'), // حالت تماشایی
	})
	.catch(() => process.exit(1));
