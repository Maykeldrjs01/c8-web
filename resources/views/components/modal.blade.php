<div>
    <div id="modal-overlay" class="z-20 fixed top-0 left-0 w-full h-full bg-black-40 transition-transform ease-in-out closed"></div>

    <div id="modal" class="modal fixed max-w-full max-h-full z-30 flex flex-col rounded bg-white transition-all ease-in-out closed shadow">
        <div class="absolute left-0 top-0 w-full h-full overflow-auto">
            <div class="pt-8 px-5">
                <div class="flex justify-between border-b-2 pb-3">
                    <h2 id="modal-name" class="text-xl font-black sticky-top"></h2>
                    <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-5 mr-3 rounded z-10 right-1 top-1 w-fit" id="close-button" onclick="closeModal()">Close</button>
                </div>
                <label class="block mt-3 mb-2 font-bold text-gray-700" for="modal-number">
                    Phone Number
                </label>
                <input class="rounded-md border-2 border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full leading-tight text-gray-700" type="text" id="modal-number" disabled>
                <label class="block mt-3 mb-2 font-bold text-gray-700" for="modal-number">
                    Group IDs
                </label>
                <div id="span-container" class="flex flex-wrap gap-3 overflow-auto p-5 border-2 border-gray-300 rounded-md mb-2">
                </div>
            </div>
        </div>
    </div>
</div>