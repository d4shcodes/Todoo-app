<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-header></x-header>

<body>

    <x-navbar></x-navbar>

    <div class="m-14 pt-6">

        @if (session('auth_status'))
            <div class="task_added p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                <span class="font-medium">{{ session('auth_status') }}</span>
            </div>
        @endif

        <h3 class="text-white font-bold text-xl mb-4">Task Assigned</h3>

        <hr>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mt-10">

            @foreach ($todo_task as $task)
                <div class="bg-[#1A1D1F] rounded-md p-10">
                    <h1 class="text-lg md:text-2xl font-extrabold text-white mb-3">{{ $task->title }}</h1>
                    <p class="text-white mb-3">{{ $task->description }}</p>
                    <div class="md:flex justify-between items-center flex-wrap gap-3">
                        <p
                            class="text-white mb-3 p-1.5 text-sm rounded-lg border border-gray-600 inline-flex items-center w-full md:w-auto">
                            <svg class="w-6 h-6 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="22" height="22" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01" />
                            </svg>
                            &nbsp;

                            {{-- Find the worker with the matching id --}}
                            @php $user = $user->where('id', $task->assigned_to)->first() @endphp
                            {{ $user->name }}
                        </p>


                        @if ($task->task_status == 0)
                            <p class="status"> <span class="bg-red-100 text-red-800 badge">On hold</span>
                            </p>
                        @elseif($task->task_status == 1)
                            <p class="status"><span class="bg-yellow-100 text-yellow-800 badge">In
                                    progress</span></p>
                        @elseif($task->task_status == 3)
                            <p class="status"><span class="bg-blue-100 text-blue-800 badge">Verifying</span></p>
                        @else
                            <p class="status"><span class="bg-green-100 text-green-800 badge">Completed</span></p>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>

    </div>

    <x-footer></x-footer>

    {{-- Modal Login --}}
    <x-modal id="login" title="Login" action="{{ url('user_auth') }}" buttonText="Login" method="POST">
        <x-input type="text" name='email' id='email' placeholder="Enter Email" value="admin@todoapp.com"
            required />

        <x-input type="password" name='pass_key' id='pass_key' placeholder="Enter Passkey" required />
    </x-modal>

</body>

</html>
