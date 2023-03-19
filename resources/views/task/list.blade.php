<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="get" action="{{ route('task.filter') }}" class="space-y-6">
                <div>
                    <select id="project_id" name="project_id" style="width:40%;display:inline;" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" >
                        <option value="" @if(isset($current_project_filter)) @if($current_project_filter == "") selected @endif @endif>--- Filter Project ---</option>
                        @foreach( $projects as $project )
                            <option value="{{ $project->id }}" @if(isset($current_project_filter)) @if($current_project_filter == $project->id) selected @endif @endif>{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    <select id="status" name="status" style="width:40%;display:inline;" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" >
                        <option value="" @if(isset($current_status_filter)) @if($current_status_filter == "") selected @endif @endif>--- Filter Project Status ---</option>
                        <option value="0" @if(isset($current_status_filter)) @if($current_status_filter == 0) selected @endif @endif>Not Completed</option>
                        <option value="1" @if(isset($current_status_filter)) @if($current_status_filter == 1) selected @endif @endif>Completed</option>
                    </select>
                    <button class="filter-button px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none">{{ __('Filter') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="div-button-margin">
                    <a href="{{ route('task.create') }}" class="btn-right px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none">{{ __('Create') }}</a>
                </div>
                <table class="table-max">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 text-m font-medium text-left text-gray-700 uppercase dark:text-gray-400">
                                Task Name
                            </th>
                            <th scope="col" class="px-6 text-m font-medium text-left text-gray-700 uppercase dark:text-gray-400">
                                Project Name
                            </th>
                            <th scope="col" class="px-6 text-m font-medium text-left text-gray-700 uppercase dark:text-gray-400">
                                Status
                            </th>
                            <th scope="col" class="px-6 text-m font-medium text-left text-gray-700 uppercase dark:text-gray-400 text-center number-col">
                                Edit
                            </th>
                            <th scope="col" class="px-6 text-m font-medium text-left text-gray-700 uppercase dark:text-gray-400 text-center number-col">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $task->task_name }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $task->project->project_name }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    @if( $task->status == 0 )
                                        <span class="dark:text-white">Not Completed</span>
                                    @else
                                        <span class="completed-text">Completed</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 text-right whitespace-nowrap dark:text-white">
                                    <a href="{{ route('task.edit', $task->id) }}" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none">{{ __('Edit') }}</a>
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 text-right whitespace-nowrap dark:text-white">
                                    <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return ConfirmDelete();" type="submit" class="px-4 py-2 bg-red-800 dark:bg-red-50 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-600 dark:hover:bg-red-600 focus:bg-red-600 dark:focus:bg-red-500 active:bg-red-800 dark:active:bg-red-50 focus:outline-none">{{ __('Delete') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function ConfirmDelete()
    {
    var x = confirm("Are you sure?");
    if (x)
        return true;
    else
        return false;
    }
</script>