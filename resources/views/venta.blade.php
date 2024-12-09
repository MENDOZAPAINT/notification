@php
    use App\Models\User;

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ventas') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('venta.store') }}" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Título')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <textarea id="description" name="description"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                            </textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Guardar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof window.Echo !== 'undefined') {
                    // Escuchamos en el canal privado del usuario actual
                    window.Echo.private(`alert.{{ Auth::id() }}`)
                        .listen('.nueva-venta', (event) => {
                            const toast = document.createElement('div');

                            toast.innerHTML = `
                            <x-toast 
                                title="${event.title}"
                                message="${event.description}"
                                type="info"
                                duration="3000"
                                width="sm"
                            />
                        `;

                            document.body.appendChild(toast.firstElementChild);
                        });
                } else {
                    console.error('Laravel Echo no está inicializado correctamente');
                }
            });
        </script>
    @endpush






    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const userRole = '{{ Auth::user()->role }}';
                const userId = '{{ Auth::id() }}';
                const notificationContainer = document.createElement('div');
                notificationContainer.className = 'fixed top-4 right-4 z-50';
                document.body.appendChild(notificationContainer);

                const renderButton = (count) => {
                    notificationContainer.innerHTML = `
                    <x-button
                        count="${count}"
                        size="lg"
                        color="#0066CC"
                    ></x-button>
                    `;
                };

                if (userRole === 'admin') {
                    renderButton({{ \App\Models\Venta::count() }});
                    window.Echo.private(`venta_notifications.${userId}`)
                        .listen('.nueva-venta', (event) => renderButton(event.count));
                } else if (userRole === null) {
                    const userVentaCount = {{ \App\Models\Venta::where('user_id', Auth::id())->count() }};
                    renderButton(userVentaCount);
                    window.Echo.private(`venta_notifications.${userId}`)
                        .listen('.nueva-venta', (event) => renderButton(event.count)); // Corrected to use event.count
                } else {
                    console.error('Usuario no reconocido');
                }
            });
        </script>
    @endpush

</x-app-layout>



{{-- 

--}}