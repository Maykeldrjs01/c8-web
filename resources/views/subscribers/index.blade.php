<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Subscribers Page!') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="flex flex-col bg-gray-100 font-sans overflow-hidden">
            <!-- Container -->
            <div class="container mx-auto w-full min-h-96 max-h-fit">
                <div class="flex justify-center items-center h-1/2 pt-10 min-h-full">
                    <!-- Row -->
                    <div class="w-full xl:w-4/5 lg:w-12/12 flex h-full">
                        <!-- Col -->
                        <div id="avatar-container" class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg" style="background-image: url('https://avatars.dicebear.com/api/adventurer-neutral/calibr8.svg')"></div>
                        <!-- Col -->
                        <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                            <form class="px-8 pt-6 pb-8 bg-white rounded">
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                        Fullname
                                    </label>
                                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none number:outline-none focus:shadow-outline" id="name" type="text" placeholder="Johny Doe" onkeydown="changeAvatar(this)"/>
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="number">
                                        Phone Number
                                    </label>
                                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="number" type="text" placeholder="09xxxxxxxxx" />
                                </div>
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="group">
                                        Group
                                    </label>
                                    <select class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                        <option selected>Calibr8</option>
                                        <option>Test Group</option>
                                    </select>
                                </div>
                                <div class="mt-16 mb-0 text-center">
                                    <button class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="button">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>