{{--
    Shared form for creating and editing a course.

    Variables passed in from create/edit:
      $action    - the URL the form submits to
      $method    - 'POST' for create, 'PUT' for edit
      $submit    - the text on the save button
      $lecturers - the users with the lecturer role (from CourseController)
      $course    - (edit only) the course being edited
--}}
<form action="{{ $action }}" method="POST" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm max-w-2xl">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="p-6 space-y-5">

        {{-- Course code --}}
        <div>
            <label for="code" class="block text-sm font-medium text-slate-600 mb-2">Course code</label>
            <input id="code" name="code" type="text" class="input-field @error('code') border-red-400 @enderror"
                   placeholder="e.g. BUC3131" value="{{ old('code', $course->code ?? '') }}">
            @error('code')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-slate-600 mb-2">Course title</label>
            <input id="title" name="title" type="text" class="input-field @error('title') border-red-400 @enderror"
                   placeholder="e.g. Advanced Web Application Development" value="{{ old('title', $course->title ?? '') }}">
            @error('title')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Credits --}}
        <div>
            <label for="credits" class="block text-sm font-medium text-slate-600 mb-2">Credit units</label>
            <input id="credits" name="credits" type="number" min="1" max="10" class="input-field @error('credits') border-red-400 @enderror"
                   placeholder="e.g. 3" value="{{ old('credits', $course->credits ?? '') }}">
            @error('credits')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lecturer: one option per user who has the lecturer role --}}
        <div>
            <label for="lecturer_id" class="block text-sm font-medium text-slate-600 mb-2">Lecturer</label>
            <select id="lecturer_id" name="lecturer_id" class="input-field @error('lecturer_id') border-red-400 @enderror">
                <option value="">Select a lecturer</option>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" @selected(old('lecturer_id', $course->lecturer_id ?? '') == $lecturer->id)>{{ $lecturer->name }}</option>
                @endforeach
            </select>
            @error('lecturer_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="px-4 py-4 bg-white border-t border-slate-200 flex justify-between">
        <a href="{{ route('courses.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 hover:bg-slate-100">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">{{ $submit }}</button>
    </div>
</form>