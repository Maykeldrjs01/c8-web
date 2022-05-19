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
            <form method="POST" action="{{ route('user.dashboard.filters') }}" class="">
                @csrf
                <div class="flex flex-row w-full mt-1">
                    <p class="place-items-center mr-2 text-lg font-black text-gray-800 flex">Filter Table <span class="ml-3 font-black text-4xl text-gray-300">|</span></p>

                    <!-- Reset button -->
                    <a href="{{ route('user.dashboard.index') }}" class="flex justify-center content-center w-32 rounded-md border border-gray-300 shadow-sm py-3 bg-red-600 text-sm font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 mr-4">Reset</a>

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


            <!-- Modal -->
            <x-modal/>

            <div class="w-full lg:w-4/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Phone Number</th>
                                <th class="py-3 px-6 text-center">Group</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">

                            <!-- Display all information about the subscribers in the table -->
                            @foreach($subs as $subscriber)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 select-none">
                                <!-- Name -->
                                <div>
                                    <td class="py-3 px-6 text-left cursor-pointer" onclick="openModal('{{ $subscriber->NAME }}','{{ $subscriber->SUBSCRIBER_NUMBER }}')">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <img class="w-10 h-10 rounded-full" src="https://avatars.dicebear.com/api/adventurer-neutral/{{ $subscriber->SUBSCRIBER_NUMBER }}.svg" />
                                            </div>
                                            <span class="text-base">{{ $subscriber->NAME }}</span>
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
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-sm">{{ $subscriber->GROUP_ID }}</span>
                                    </td>
                                </div>
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