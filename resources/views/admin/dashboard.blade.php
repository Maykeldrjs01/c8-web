<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Dashboard Page!')}}
        </h2>
    </x-slot>

    @if (session('success_message'))
    <div class="alert alert-sucess">
        {{ session('success_message') }}
    </div>
    @endif

    <div class="py-12">
        <div class="flex flex-col items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <!-- Filter section -->
            <form method="POST" action="{{ route('admin.dashboard.filters') }}" class="">
                @csrf
                <div class="flex flex-row w-full mt-1">
                    <p class="place-items-center mr-2 text-lg font-black text-gray-800 flex">Filter Table <span class="ml-3 font-black text-4xl text-gray-300">|</span></p>

                    <!-- Reset button -->
                    <a href="{{ route('admin.dashboard.index') }}" class="flex justify-center content-center w-32 rounded-md border border-gray-300 shadow-sm py-3 bg-red-600 text-sm font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 mr-4">Reset</a>

                    <!-- Submit filter button -->
                    <input type="submit" value="Submit" class="flex justify-center w-32 rounded-md border border-gray-300 shadow-sm bg-blue-400 text-sm font-bold text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-sky-500">

                    <!-- Dropdown filters button -->
                    <select name="group" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-primary ml-1" require>
                        <option disabled selected>Select Group</option>
                        @foreach($groups as $option)
                        @if(isset($filter))

                        <option value="{{ $option->GROUP_ID }}" @if($option->GROUP_ID == $filter)
                            selected="true"
                            @endif
                            >{{ $option->GROUP_ID }}</option>
                        @else
                        <option value="{{ $option->GROUP_ID }}">{{ $option->GROUP_ID }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </form>
            <!-- End filer section -->

            <x-modal />

            <!-- Table -->
            <div class="w-full lg:w-4/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Phone Number</th>
                                <th class="py-3 px-6 text-center">Group</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">

                            <!-- Display all information about the subscribers in the table -->
                            @foreach($subs as $subscriber)
                            <tr class="border-b border-gray-200 hover:bg-gray-100" onclick="openModal('{{ $subscriber->NAME }}','{{ $subscriber->SUBSCRIBER_NUMBER }}')">
                                <!-- Name -->
                                <div onclick="openModal()">
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <img class="w-10 h-10 rounded-full" src="https://avatars.dicebear.com/api/adventurer-neutral/{{ $subscriber->SUBSCRIBER_NUMBER }}.svg" />
                                            </div>
                                            <span>{{ $subscriber->NAME }}</span>
                                        </div>
                                    </td>

                                    <!-- Phone Number -->
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $subscriber->SUBSCRIBER_NUMBER }}</span>
                                        </div>
                                    </td>

                                    <!-- Group -->
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $subscriber->GROUP_ID }}</span>
                                    </td>
                                </div>
                                <!-- Actions -->
                                <td class="py-3 px-6 text-center">
                                    <div class="flex ">
                                        <div class="w-14 mr-0 transform hover:scale-110 transition ease-in-out">
                                            <form id="subs-edit" method="POST" action="{{ route('admin.subscribers.edit') }}">
                                                @csrf
                                                <!-- Hidden input for form submission (NO NEED TO CHANGE THE LAYOUT) -->
                                                <input type="hidden" name="name" value="{{ $subscriber->NAME }}">
                                                <input type="hidden" name="group_id" value="{{ $subscriber->GROUP_ID }}">
                                                <!-- Edit button -->
                                                <x-button type="submit" class="transition-transform bg-green-500 hover:bg-green-600 ease-linear duration-500">
                                                    Edit
                                                </x-button>
                                            </form>
                                        </div>
                                        <div class="w-2 ml-5 transform hover:scale-110 transition ease-in-out">
                                            <form method="POST" action="{{ route('admin.subscribers.delete') }}">
                                                @method('DELETE')
                                                @csrf
                                                <!-- Hidden input for form submission (NO NEED TO CHANGE THE LAYOUT) -->
                                                <input type="hidden" name="name" value="{{ $subscriber->NAME }}">
                                                <input type="hidden" name="group_id" value="{{ $subscriber->GROUP_ID }}">
                                                <!-- Delete button -->
                                                <x-button type="submit" class="bg-red-500 hover:bg-red-800" onclick="return confirm('This action cannot be undone. Are you sure?')">
                                                    Delete
                                                </x-button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Show the pagination buttons if exists -->
                    <div class="p-5">
                        @if (method_exists($subs, 'links'))
                        {{ $subs->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>