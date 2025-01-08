<x-layout>
    <br>
<h1 class="text-center text-3xl mb-4 font-bold p-3 border border-gray-300">Welcome Home!</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($job as $x)
            <div>
                <x-job-card :job="$x" />
            </div>
        @empty
            <p>No job Available</p>

        @endforelse
    </div>

    <a href="{{route("job.index")}}" class="block text-center text-3xl mb-4 font-bold  border border-gray-300">
        <i class="fa fa-arrow-alt-circle-right"></i>
        Show More
    </a>

</x-layout>
