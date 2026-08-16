@extends('layout.master')

@section('content')
    <section class="max-w-container mx-auto px-4 pt-8 sm:pt-12">
        <div class="relative h-[320px] sm:h-[420px] overflow-hidden rounded-theme shadow-theme-lg">
            <img src="{{ asset('images/pantheon-hero/ext-3.jpg') }}" alt="The Pantheon, Rome"
                 class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-theme-bg via-black/50 to-black/10"></div>

            <div class="absolute inset-x-0 bottom-0 px-6 sm:px-10 pb-8">
                <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.35em] text-white/70">
                    About
                </span>
                <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight max-w-2xl">
                    The story behind the stories
                </h1>
            </div>
        </div>
    </section>

    <section class="max-w-container mx-auto px-4 py-12 sm:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-5 text-theme-body leading-relaxed">
                <p>
                    An experienced IT professional currently serving as the Chief Services Officer (CSO) at BOL.
                    With a strong background in IT-enabled services, infrastructure management, and software
                    development, I have led multiple teams, ensuring efficient service delivery and technological
                    innovation.
                </p>
                <p>
                    Over the years, I have successfully managed technical departments, restructured customer
                    service teams, optimized network infrastructure, and developed IT governance policies. My
                    expertise spans network engineering, data infrastructure, and skill development.
                </p>
                <p>
                    Passionate about innovation, technology, and leadership, I continuously strive to enhance IT
                    solutions and improve business operations. Let's connect and collaborate on transformative
                    tech initiatives!
                </p>
            </div>

            <aside class="rounded-theme border border-theme-line bg-theme-surface p-6 shadow-theme h-fit">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center size-12 rounded-full bg-theme-primary/15 text-theme-primary font-extrabold text-lg shrink-0">
                        KH
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-theme-ink leading-tight">Kazi Akramul Haque</h2>
                        <p class="text-sm text-theme-muted">Chief Services Officer, BOL</p>
                    </div>
                </div>

                <div class="flex flex-col gap-3" x-data="{ showNumber: false }">
                    <a rel="noopener" target="_blank" href="https://www.linkedin.com/in/tasinkazi"
                       class="flex items-center gap-3 rounded-theme-sm border border-theme-line bg-theme-surface-raised px-4 py-3 text-sm font-semibold text-theme-ink hover:border-theme-primary/50 hover:text-theme-primary transition-colors">
                        <img class="size-5" src="{{ asset('images/icons/linkedin.png') }}" alt="LinkedIn"/>
                        LinkedIn
                    </a>
                    <a rel="noopener" target="_blank" href="mailto:tasinkazi@gmail.com"
                       class="flex items-center gap-3 rounded-theme-sm border border-theme-line bg-theme-surface-raised px-4 py-3 text-sm font-semibold text-theme-ink hover:border-theme-primary/50 hover:text-theme-primary transition-colors">
                        <img class="size-5" src="{{ asset('images/icons/mail.png') }}" alt="Email"/>
                        Email me
                    </a>
                    <button type="button" @click="showNumber = !showNumber"
                            class="flex items-center gap-3 rounded-theme-sm border border-theme-line bg-theme-surface-raised px-4 py-3 text-sm font-semibold text-theme-ink hover:border-theme-primary/50 hover:text-theme-primary transition-colors text-left">
                        <img class="size-5" src="{{ asset('images/icons/telephone.png') }}" alt="Phone"/>
                        <span x-text="showNumber ? '+88001976672358' : 'Call me'"></span>
                    </button>
                </div>
            </aside>
        </div>
    </section>
@endsection

@section('JScript')
    <script src="{{ asset('js/alpinejs-3.13.3.js') }}"></script>
@endsection
