/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./**/*.php', // همه فایل‌های PHP
		'./templates/**/*.php', // فایل‌های تمپلیت
		'./assets/**/*.{html,js}', // فایل‌های HTML و JS
	],
	theme: {
		extend: {},
	},
	plugins: [],
};
