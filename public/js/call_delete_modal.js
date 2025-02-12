document.addEventListener("DOMContentLoaded", function() {
	const modalOverlay = document.getElementById("modalOverlay");
	const openModalBtn = document.getElementById("openModalBtn");
	const closeModalBtn = document.getElementById("closeModalButton");
	const confirmDeleteBtn = document.getElementById("deleteConfirmButton");
	const deleteForm = document.getElementById("deleteForm");

	openModalBtn.addEventListener("click", function() {
		modalOverlay.style.display = "flex";
	});

	closeModalBtn.addEventListener("click", function() {
		modalOverlay.style.display = "none";
	});

	confirmDeleteBtn.addEventListener("click", function() {
		deleteForm.submit();
	});
});
 