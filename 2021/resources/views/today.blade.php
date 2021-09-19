<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="text-center">{{ \Carbon\Carbon::now()->format("Y/m/d") }}</div>

                <table class="table">
                <thead>
                    <th>午前</th>
                    <th>午後</th>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
