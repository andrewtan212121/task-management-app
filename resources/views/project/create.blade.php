<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('project.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="project_name" :value="__('Project Name')" />
                            <x-text-input id="project_name" name="project_name" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="project_description" :value="__('Project Description')" />
                            <x-text-input id="project_description" name="project_description" type="text" class="mt-1 block w-full" />
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
