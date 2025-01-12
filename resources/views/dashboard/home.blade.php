{{-- <p>Login ID: {{ Session::get('loginID') }}</p> --}}

<x-header></x-header>

<body>

    <x-navbar></x-navbar>

    <div class="m-14 pt-6">

        @if (session('task_status'))
            <div class="task_added p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                <span class="font-medium">{{ session('task_status') }}</span>
            </div>
        @endif

        <div class="flex justify-between">

            <h1 class="text-2xl font-extrabold text-white mb-3"> Welcome {{ $user_session->name }}</h1>

            @if ($user_session->status == 0)
                <a class="text-3xl font-bold text-white mb-10 cursor-pointer" data-modal-target="add_task"
                    data-modal-toggle="add_task"> + </a>
            @endif
        </div>

        <hr>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mt-10">
            @foreach ($todo_task as $task)
                <div class="bg-[#1A1D1F] rounded-md p-10">
                    <h1 class="text-lg md:text-3xl font-extrabold text-white mb-3">{{ $task->title }}</h1>
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
                            @php $worker = $workers->firstWhere('id', $task->assigned_to) @endphp
                            {{ $worker->name }}

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


                    <hr>

                    @if ($user_session->status == 0)
                        <div class="flex justify-around">
                            <svg class="w-6 h-6 text-white mt-5 cursor-pointer" width="22" height="22"
                                fill="currentColor" viewBox="0 0 24 24"
                                data-modal-target="edit_task_{{ $task->id }}"
                                data-modal-toggle="edit_task_{{ $task->id }}">
                                <path fill-rule="evenodd"
                                    d="M15.514 3.293a1 1 0 0 0-1.415 0L12.151 5.24a.93.93 0 0 1 .056.052l6.5 6.5a.97.97 0 0 1 .052.056L20.707 9.9a1 1 0 0 0 0-1.415l-5.193-5.193ZM7.004 8.27l3.892-1.46 6.293 6.293-1.46 3.893a1 1 0 0 1-.603.591l-9.494 3.355a1 1 0 0 1-.98-.18l6.452-6.453a1 1 0 0 0-1.414-1.414l-6.453 6.452a1 1 0 0 1-.18-.98l3.355-9.494a1 1 0 0 1 .591-.603Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg class="w-6 h-6 text-white mt-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                                width="22" height="22" fill="none" viewBox="0 0 24 24"
                                data-modal-target="delete_task_{{ $task->id }}"
                                data-modal-toggle="delete_task_{{ $task->id }}">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                        </div>
                    @else
                        <div class="mt-3">

                            @php
                                $status_arr = [0, 2, 3];
                            @endphp
                            <form action="{{ url('update_task/' . $task->id . '/1') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    {{ in_array($task->task_status, $status_arr) ? 'disabled' : '' }}
                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                                    Verify completion
                                </button>
                            </form>
                        </div>
                    @endif


                </div>

                {{-- Modal Edit --}}
                <x-modal id="edit_task_{{ $task->id }}" title="Edit Task"
                    action="{{ url('update_task/' . $task->id . '/2') }}" buttonText="Edit Task" method="POST">
                    @method('PUT')
                    <label>Title</label>
                    <x-input type="text" name='edt_title' id='edt_title' placeholder="Enter Title" required
                        value="{{ $task->title }}" />
                    <br>
                    <label>Description</label>
                    <x-textarea name="edt_task_description" id="edt_task_description"
                        placeholder="Enter task description" required>{{ $task->description }}</x-textarea>
                    <br>
                    <label>Status</label>
                    <x-select-dropdown name="edt_task_status" id="edt_task_status" :options="[
                        0 => 'On hold',
                        1 => 'In progress',
                        2 => 'Completed',
                        3 => 'Verifying',
                    ]"
                        :selected="$task->task_status" />
                    <br>
                    <label>Assign to</label>
                    <x-select-dropdown name="edt_assigned_to" id="edt_assigned_to" :options="$workers->pluck('name', 'id')->toArray()"
                        :selected="$task->assigned_to" />

                </x-modal>

                <x-modal id="delete_task_{{ $task->id }}" title="Delete Task"
                    action="{{ url('delete_task', $task->id) }}" buttonText="Delete Task" method="POST">
                    @method('DELETE')
                    <label>Are you sure you want to delete this task ? </label>
                </x-modal>
            @endforeach
        </div>
    </div>

    <x-footer></x-footer>

    {{-- Modal Add --}}
    <x-modal id="add_task" title="Add Task" action="{{ url('add_task') }}" buttonText="Add Task" method="POST">
        <label>Title</label>
        <x-input type="text" name='title' id='title' placeholder="Enter Title" required />
        <br>
        <label>Description</label>
        <x-textarea name="task_description" id="task_description" placeholder="Enter task description" required />
        <br>
        <label>Status</label>
        <x-select-dropdown name="task_status" id="task_status" :options="[
            0 => 'On hold',
            1 => 'In progress',
            2 => 'Completed',
            3 => 'Verifying',
        ]" :selected="1" />
        <br>
        <label>Assign to</label>
        <x-select-dropdown name="assigned_to" id="assigned_to" :options="$workers->pluck('name', 'id')->toArray()" />
    </x-modal>


    <script>
        //To suppress the error & warning message in the console
        console.error = console.warn = function() {};
    </script>


</body>
