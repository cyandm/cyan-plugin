const axios = require('axios');
const fetch = require('node-fetch');
const { execSync } = require('child_process');

const GITHUB_TOKEN = process.env.TOKEN; // توکن را از محیط دریافت می‌کند
const REPO_OWNER = 'cyandm'; // نام کاربری شما در گیت‌هاب
const REPO_NAME = 'cyan-plugin'; // نام ریپازیتوری شما
const sha = process.env.GITHUB_SHA; // SHA آخرین کامیت

async function getCommitMessage(repo, sha, token) {
	const response = await fetch(
		`https://api.github.com/repos/${repo}/commits/${sha}`,
		{
			headers: {
				Authorization: `token ${token}`,
				Accept: 'application/vnd.github.v3+json',
			},
		}
	);

	if (!response.ok) {
		throw new Error('Failed to fetch commit message');
	}

	const data = await response.json();
	return data.commit.message; // بازگشت پیام کامیت
}

async function createRelease(tagname) {
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
				tag_name: tagname,
				name: tagname,
				body: 'Release created automatically via GitHub Actions',
			},
			{
				headers: {
					Authorization: `token ${GITHUB_TOKEN}`,
					'Content-Type': 'application/json',
				},
			}
		);

		console.log(`Release ${tagname} created successfully.`);
	} catch (error) {
		console.error(
			`Error: ${error.response ? error.response.data.message : error.message}`
		);
	}
}

(async () => {
	const commitMessage = await getCommitMessage(REPO_NAME, sha, GITHUB_TOKEN);
	const TAG_NAME = commitMessage; // استفاده از پیام کامیت به عنوان نام تگ

	await createRelease(TAG_NAME);
})();
