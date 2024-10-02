function CopyButtons() {
	const buttons = document.querySelectorAll('button[data-copy]');
	if (!buttons) return;

	buttons.forEach((btn) => {
		btn.addEventListener('click', (e) => {
			e.preventDefault();
			navigator.clipboard
				.writeText(btn.dataset.copy)
				.then(() => {
					alert(btn.dataset.copy + ' کپی شد!');
				})
				.catch((error) => {
					alert('خطا در کپی کردن: ' + error);
				});
		});
	});
}

CopyButtons();
