<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Viewing '.$name.' of '.$group.'.' }}
        </h2>
    </x-slot>

    <div class="flex flex-col font-sans overflow-hidden">
        <!-- Container -->
        <div class="container mx-auto w-full min-h-96 max-h-fit">
            <div class="flex justify-center items-center h-1/2 pt-10 min-h-full">
                <!-- Row -->
                <div class="w-full xl:w-4/5 lg:w-12/12 grid h-full place-items-center">
                    <!-- Col -->

                    <!-- <div id="avatar-container" class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg" style="background-image: url('https://avatars.dicebear.com/api/adventurer-neutral/calibr8.svg')"></div> -->

                    <!-- Col -->
                    <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg shadow-lg mb-5">

                        <!-- <x-auth-validation-errors class="mb-4 px-8 text-xl" :errors="$errors" /> -->

                        <form class="px-8 pt-6 pb-8 bg-white rounded" method="POST" action="">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="block mb-2 font-bold text-gray-700" for="name">
                                    Fullname
                                </label>

                                <x-input id="name" class="block mt-1 w-full leading-tight text-gray-700" type="text" name="name" :value="$name" placeholder="Johnny Doe" :disabled="true" autofocus />
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-bold text-gray-700" for="number">
                                    Phone Number
                                </label>
                                <x-input id="number" class="block mt-1 w-full leading-tight text-gray-700" type="text" name="number" :value="$number" placeholder="09xxxxxxxxx" disabled="true" required />
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 font-bold text-gray-700" for="group">
                                    Group
                                </label>
                                <select class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" name="group" disabled>
                                    <option value="CALIBR8" selected="true">Calibr8</option>
                                    <option value="TEST">Test</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-center text-gray-600">
                                You are not allowed to make changes
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>