{{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let toastData = @json(session('toast'));

        if (toastData) {
            showToast(toastData.type, toastData.title, toastData.message);
        }

        function showToast(type, title, message) {
            const toastContainer = document.getElementById("toast-message");
            const toastTitle = document.getElementById("toast-title");
            const toastText = document.getElementById("toast-text");
            const toastIcon = document.getElementById("toast-icon");

            toastTitle.textContent = title;
            toastText.textContent = message;

            if (type === "success") {
                toastIcon.innerHTML = `<svg class="size-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>`;
            } else if (type === "error") {
                toastIcon.innerHTML = `<svg class="size-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>`;
            }

            toastContainer.classList.remove("hidden");
            setTimeout(() => {
                toastContainer.classList.add("hidden");
            }, 3000);

            document.getElementById("toast-close").addEventListener("click", function () {
                toastContainer.classList.add("hidden");
            });
        }
    });
</script>

