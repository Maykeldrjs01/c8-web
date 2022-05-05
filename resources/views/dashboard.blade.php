<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Dashboard Page ').Auth::user()->name.('!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <form method="post" action="{{ route('dashboard.filters') }}">
                @csrf
                <input type="submit" value="Submit">
                <select name="group">
                    @foreach($groups as $option)
                    <option value="{{ $option->GROUP_ID }}" 
                    @isset ( $filter )
                        @if($option->GROUP_ID == $filter)
                            selected="true"
                        @endif
                    @endisset
                    >{{ $option->GROUP_ID }}</option>
                    @endforeach
                </select>
            </form>
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
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <!-- Name -->
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-10 h-10 rounded-full" src="https://avatars.dicebear.com/api/adventurer-neutral/{{ $subscriber->SUBSCRIBER_NUMBER }}.svg" />
                                        </div>
                                        <span>{{ $subscriber->NAME }}</span>
                                    </div>
                                </td>

                                <!-- Phone Number -->
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">(+63) {{ $subscriber->SUBSCRIBER_NUMBER }}</span>
                                    </div>
                                </td>

                                <!-- Group -->
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $subscriber->GROUP_ID }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-5 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-5 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Show the pagination buttons if exists -->
                    @if (method_exists($subs, 'links'))
                    {{ $subs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>