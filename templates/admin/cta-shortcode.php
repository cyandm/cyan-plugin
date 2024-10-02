<?php

global $post;

?>

<div class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-md">
	<span>
		[cyan_cta id="<?php echo $post->ID ?>"]
	</span>

	<button class="copyBtn | px-3 py-1 bg-slate-800 text-white rounded-md"
			data-copy="[cyan_cta id='<?php echo $post->ID ?>']">
		کپی
	</button>
</div>