<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AuthorProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorProfileController extends Controller
{
    /**
     * List all author profiles.
     *
     * @return View
     */
    public function list(): View
    {
        $profiles = AuthorProfile::where('user_id', auth_user('web')->id)->latest()->paginate(paginateNumber());
        return view('user.author_profile.list', [
            'meta_data' => $this->metaData(['title' => 'Author Profiles']),
            'profiles' => $profiles,
        ]);
    }

    /**
     * Edit an author profile.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $profile = AuthorProfile::where('id', $id)->where('user_id', auth_user('web')->id)->firstOrFail();

        return view('user.author_profile.edit', [
            'meta_data' => $this->metaData(['title' => 'Edit Author Profile']),
            'profile' => $profile,
        ]);
    }

    /**
     * Update an author profile.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'tone' => 'required|string',
            'style' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $profile = AuthorProfile::where('id', $id)->where('user_id', auth_user('web')->id)->firstOrFail();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('author_profiles', 'public');
        }

        $profile->update($validated);

        return redirect()->route('author.profile.list')->with('success', 'Author profile updated successfully.');
    }

    /**
     * Store a new author profile.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'tone' => 'required|string',
            'style' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = auth_user('web')->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('author_profiles', 'public');
        }

        AuthorProfile::create($validated);

        return redirect()->route('author.profile.list')->with('success', 'Author profile created successfully.');
    }

    /**
     * Create a new author profile.
     *
     * @return View
     */
    public function create(): View
    {
        $tones = getToneList();
        $styles = getWritingStyles();
        return view('user.author_profile.create', [
            'meta_data' => $this->metaData(['title' => 'Create Author Profile']),
            'tones' => $tones,
            'styles' => $styles,
        ]);
    }

    /**
     * Create a new author profile.
     *
     * @return View
     */
    public function show(): View
    {
        return view('user.author_profile.create', [
            'meta_data' => $this->metaData(['title' => 'Create Author Profile']),
        ]);
    }

    /**
     * Delete an author profile.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $profile = AuthorProfile::where('id', $id)->where('user_id', auth_user('web')->id)->firstOrFail();
        $profile->delete();

        return back()->with('success', 'Author profile deleted successfully.');
    }
}
