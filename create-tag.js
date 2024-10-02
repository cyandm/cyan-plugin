const axios = require('axios');
const { execSync } = require('child_process');

const GITHUB_TOKEN = process.env.GITHUB_TOKEN; // توکن را از محیط دریافت می‌کند
const REPO_OWNER = 'cyandm'; // نام کاربری شما در گیت‌هاب
const REPO_NAME = 'cyan-plugin'; // نام ریپازیتوری شما
const TAG_NAME = process.env.GITHUB_REF.split('/').pop(); // استخراج نام تگ از GITHUB_REF

async function createRelease() {
	try {
		// ایجاد تگ جدید
		await axios.post(
			`https://api.github.com/repos/${REPO_OWNER}/${REPO_NAME}/git/refs`,
			{
				ref: `refs/tags/${TAG_NAME}`,
				sha: execSync('git rev-parse HEAD').toString().trim(), // آخرین SHA از کامیت
			},
			{
				headers: {
					Authorization: `token ${GITHUB_TOKEN}`,
					'Content-Type': 'application/json',
				},
			}
		);

		// ایجاد ریلیز
		await axios.post(
			`https://api.github.com/repos/${REPO_OWNER}/${REPO_NAME}/releases`,
			{
				tag_name: TAG_NAME,
				name: TAG_NAME,
				body: 'Release created automatically via GitHub Actions',
			},
			{
				headers: {
					Authorization: `token ${GITHUB_TOKEN}`,
					'Content-Type': 'application/json',
				},
			}
		);

		console.log(`Release ${TAG_NAME} created successfully.`);
	} catch (error) {
		console.error(
			`Error: ${error.response ? error.response.data.message : error.message}`
		);
	}
}

// اجرای تابع ایجاد ریلیز
createRelease();
