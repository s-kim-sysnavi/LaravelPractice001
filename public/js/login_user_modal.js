document.addEventListener("DOMContentLoaded", function() {
    const profileImage = document.getElementById("profileImage");
    const profileModal = document.getElementById("profileModal");
    const closeModal = document.getElementById("closeModal");

    if (!profileImage || !profileModal || !closeModal) {
        console.error("モーダルの要素が見つかりません。HTMLを確認してください。");
        return;
    }

    // 画像クリックでモーダル表示
    profileImage.addEventListener("click", function() {
        profileModal.style.display = "block";
    });

    // 閉じるボタンでモーダルを閉じる
    closeModal.addEventListener("click", function() {
        profileModal.style.display = "none";
    });

    // モーダル外をクリックしたら閉じる
    window.addEventListener("click", function(event) {
        if (event.target === profileModal) {
            profileModal.style.display = "none";
        }
    });
});
