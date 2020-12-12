<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subscribe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('subscribe.post') }}" method="post">
                        @csrf
                        <div class="w-1/2 form-row">
                            <div class="mt-4">
                                <input type="radio" name="plan" id="standard" value="standard"
                                       checked>
                                <label for="standard">Standard - $10 / month</label> <br>

                                <input type="radio" name="plan" id="premium" value="premium"
                                       checked>
                                <label for="premium">Premium - $20 / month</label>
                            </div>
                        </div>

                        <x-jet-button class="mt-4">
                            Subscribe Now
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
