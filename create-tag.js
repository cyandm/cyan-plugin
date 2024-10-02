const { exec } = require('child_process');
const fs = require('fs');

const filePath = process.argv[2]; // Path to the file
const version = process.argv[3]; // Version number

if (!filePath || !version) {
	console.error('Please specify the file path and version.');
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
	exec(
		`git commit -a -m "Add ${filePath}" && git tag v${version}`,
		(error, stdout, stderr) => {
			if (error) {
				console.error(`Error creating tag: ${stdout}`);
				return;
			}

			console.log(`Tag v${version} created successfully.`);
		}
	);
});
