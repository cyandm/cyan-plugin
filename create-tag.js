const { exec } = require('child_process');
const fs = require('fs');

const filePath = './output.zip'; // Path to the file
const version = process.argv[2]; // Version number
const repositoryUrl = 'https://github.com/cyandm/cyan-plugin'; // Repository URL

if (!filePath || !version || !repositoryUrl) {
	console.error('Please specify the file path, version, and repository URL.');
	process.exit(1);
}

// Check if the file exists
if (!fs.existsSync(filePath)) {
	console.error(`File ${filePath} does not exist.`);
	process.exit(1);
}

// Stage the file
exec(`git add ${filePath}`, (error, stdout, stderr) => {
	if (error) {
		console.error(`Error adding file: ${stderr}`);
		return;
	}

	// Create the new tag
	exec(`git tag v${version}`, (error, stdout, stderr) => {
		if (error) {
			console.error(`Error creating tag: ${stderr}`);
			return;
		}

		// Push the tag to the specified repository
		exec(`git push ${repositoryUrl} v${version}`, (error, stdout, stderr) => {
			if (error) {
				console.error(`Error pushing tag: ${stderr}`);
				return;
			}

			console.log(
				`Tag v${version} created and pushed to ${repositoryUrl} successfully.`
			);
		});
	});
});
