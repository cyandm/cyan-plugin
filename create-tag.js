// توکن GitHub و اطلاعات ریپازیتوری
const GITHUB_TOKEN =
	'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';
const OWNER = 'cyandm'; // نام کاربری یا سازمان گیت‌هاب
const REPO = 'cyan-plugin'; // نام ریپازیتوری

// اطلاعات تگ و ریلیز
const tagName = 'v1.0.5';
const targetCommitish = 'main';
const releaseName = 'v1.0.5';
const releaseBody = 'This is the release description';

// تابع برای ساخت تگ
async function createTag() {
	const url = `https://api.github.com/repos/${OWNER}/${REPO}/git/tags`;
	const tagData = {
		tag: tagName,
		message: releaseBody,
		object: targetCommitish, // commit یا برنچ مورد نظر
		type: 'commit',
		tagger: {
			name: 'Your Name',
			email: 'your-email@example.com',
			date: new Date().toISOString(),
		},
	};

	const response = await fetch(url, {
		method: 'POST',
		headers: {
			Authorization: `token ${GITHUB_TOKEN}`,
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(tagData),
	});

	if (!response.ok) {
		throw new Error(`Failed to create tag: ${response.statusText}`);
	}

	const tag = await response.json();
	console.log('Tag created:', tag);
}

// تابع برای ساخت ریلیز
async function createRelease() {
	const url = `https://api.github.com/repos/${OWNER}/${REPO}/releases`;
	const releaseData = {
		tag_name: tagName,
		target_commitish: targetCommitish,
		name: releaseName,
		body: releaseBody,
		draft: false,
		prerelease: false,
	};

	const response = await fetch(url, {
		method: 'POST',
		headers: {
			Authorization: `token ${GITHUB_TOKEN}`,
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(releaseData),
	});

	if (!response.ok) {
		throw new Error(`Failed to create release: ${response.statusText}`);
	}

	const release = await response.json();
	console.log('Release created:', release);
}

// اجرای فرآیند ساخت تگ و ریلیز
(async () => {
	try {
		await createTag(); // ابتدا تگ ایجاد می‌شود
		await createRelease(); // سپس ریلیز ایجاد می‌شود
	} catch (error) {
		console.error('Error:', error.message);
	}
})();
