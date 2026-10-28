{{--
    Shared form for creating and editing a student.

    Variables passed in from create/edit:
      $action  - the URL the form submits to
      $method  - 'POST' for create, 'PUT' for edit
      $submit  - the text on the save button
      $student - (edit only) the student being edited
--}}
<form action="{{ $action }}" method="POST" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm max-w-2xl">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="p-6 space-y-5">

        {{-- Full name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-slate-600 mb-2">Full name</label>
            <input id="name" name="name" type="text" class="input-field @error('name') border-red-400 @enderror"
                   placeholder="Full name" value="{{ old('name', $student->name ?? '') }}">
            @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Student number --}}
        <div>
            <label for="student_number" class="block text-sm font-medium text-slate-600 mb-2">Student number</label>
            <input id="student_number" name="student_number" type="text" class="input-field @error('student_number') border-red-400 @enderror"
                   placeholder="e.g. 24/U/0611" value="{{ old('student_number', $student->student_number ?? '') }}">
            @error('student_number')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-slate-600 mb-2">Email</label>
            <input id="email" name="email" type="email" class="input-field @error('email') border-red-400 @enderror"
                   placeholder="name@mubs.ac.ug" value="{{ old('email', $student->email ?? '') }}">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-slate-600 mb-2">Phone (optional)</label>
            <input id="phone" name="phone" type="text" class="input-field @error('phone') border-red-400 @enderror"
                   placeholder="+256 ..." value="{{ old('phone', $student->phone ?? '') }}">
            @error('phone')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="px-4 py-4 bg-white border-t border-slate-200 flex justify-between">
        <a href="{{ route('students.index') }}" class="px-4 py-2 border border-slate-200 rounded-lg text-sm text-slate-600 hover:bg-slate-100">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-[#2563eb] rounded-lg text-sm font-medium text-white hover:bg-[#1d4ed8]">{{ $submit }}</button>
    </div>
</form>
