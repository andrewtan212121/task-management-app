<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('task.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="task_name" :value="__('Task Name')" />
                            <x-text-input id="task_name" name="task_name" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="project_id" :value="__('Project Name')" />
                            <select id="project_id" name="project_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" >
                                @foreach( $projects as $project )
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="task_description" :value="__('Task Description')" />
                            <x-text-input id="task_description" name="task_description" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="completed" :value="__('Status')" />
                            <select id="status" name="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" >
                                <option value="0">Not Completed</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
