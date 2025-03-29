{{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('toast'))
        let toastData = @json(session('toast'));
        showToast(toastData.type, toastData.title, toastData.message);
        @endif

        @if ($errors->any())
        showToast("error", "Validation Error", "{{ implode(', ', $errors->all()) }}");
        @endif

        document.getElementById('toast-close').addEventListener('click', function () {
            hideToast();
        });
    });

    function showToast(type, title, message) {
        let toast = document.getElementById('toast-message');
        let toastIcon = document.getElementById('toast-icon');
        let toastTitle = document.getElementById('toast-title');
        let toastText = document.getElementById('toast-text');

        toastTitle.innerText = title;
        toastText.innerText = message;

        if (type === "success") {
            toastIcon.innerHTML = `<svg class="size-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>`;
        } else {
            toastIcon.innerHTML = `<svg class="size-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"/>
                          </svg>`;
        }

        toast.classList.remove("hidden");
        toast.style.opacity = "1";

        setTimeout(() => {
            hideToast();
        }, 3000);
    }

    function hideToast() {
        let toast = document.getElementById('toast-message');
        toast.style.opacity = "0";
        setTimeout(() => {
            toast.classList.add("hidden");
        }, 500);
    }

</script>

