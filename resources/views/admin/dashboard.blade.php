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
            <form method="post" action="{{ route('admin.dashboard.filters') }}">
                @csrf
                <input type="submit" value="Submit">
                <select name="group">
                    @foreach($groups as $option)
                    <option value="{{ $option->group_id }}" @isset ( $filter ) @if($option->group_id == $filter)
                        selected="true"
                        @endif
                        @endisset
                        >{{ $option->group_id }}</option>
                    @endforeach
                </select>
                <a href="{{ route('admin.dashboard.index') }}"> Reset</a>
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
                                            <img class="w-10 h-10 rounded-full" src="https://avatars.dicebear.com/api/adventurer-neutral/{{ $subscriber->subscriber_number }}.svg" />
                                        </div>
                                        <span>{{ $subscriber->name }}</span>
                                    </div>
                                </td>

                                <!-- Phone Number -->
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">(+63) {{ $subscriber->subscriber_number }}</span>
                                    </div>
                                </td>

                                <!-- Group -->
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $subscriber->group_id }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex ">
                                        <div class="w-14 mr-0 transform hover:scale-110 transition ease-in-out">
                                            <form id="subs-edit" method="GET" action="{{ route('admin.subscribers.edit', ['id'=>$subscriber->id]) }}">
                                                @csrf
                                                <x-button type="submit" class="transition-transform bg-green-500 hover:bg-green-600 ease-linear duration-500">Edit</x-button>
                                            </form>
                                        </div>
                                        <div class="w-2 ml-5 transform hover:scale-110 transition ease-in-out">
                                            <form method="POST" action="{{ route('admin.subscribers.delete', ['id'=>$subscriber->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <x-button type="submit" class="bg-red-500 hover:bg-red-800" onclick="return confirm('Are you sure?')">Delete
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