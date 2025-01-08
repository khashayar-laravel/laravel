<x-layout>
    <div class="bg-blue-900 h-24 px-4 mb-4 flex justify-center items-center rounded">
        <x-search />
    </div>
    {{-- Back button --}}
    @if(request()->has('keywords') || request()->has('location'))
        <a href="{{route('job.index')}}"
           class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
            <i class="fa fa-arrow-left mr-1"></i> Back
        </a>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($job as $x)
            <div>
                <x-job-card :job="$x" />
            </div>
            @empty
            <p>No job Available</p>
            @endforelse
    </div>
<ul>


</ul>
{{$job->links()}}
</x-layout>
