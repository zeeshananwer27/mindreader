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
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $author = AuthorProfile::where('uid', $id)->where('user_id', auth_user('web')->id)->firstOrFail();
        $tones = getToneList();
        $styles = getWritingStyles();

        return view('user.author_profile.edit', [
            'meta_data' => $this->metaData(['title' => 'Edit Author Profile']),
            'author' => $author,
            'tones' => $tones,
            'styles' => $styles,
        ]);
    }

    /**
     * Update an author profile.
     *
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'tone' => 'required|string',
            'style' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $profile = AuthorProfile::where('uid', $id)->where('user_id', auth_user('web')->id)->firstOrFail();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('author_profiles', 'public');
        }

        $profile->update($validated);

        return redirect()->route('user.book.author.list')->with('success', 'Author profile updated successfully.');
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

        return redirect()->route('user.book.author.list')->with('success', 'Author profile created successfully.');
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
    public function show(string $id): View
    {
        $author = AuthorProfile::where('uid', $id)->where('user_id', auth_user('web')->id)->firstOrFail();

        return view('user.author_profile.show', [
            'meta_data' => $this->metaData(['title' => 'View Author Profile']),
            'author' => $author,
        ]);
    }

    /**
     * Delete an author profile.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $profile = AuthorProfile::where('uid', $id)->where('user_id', auth_user('web')->id)->firstOrFail();
        $profile->delete();

        return back()->with('success', 'Author profile deleted successfully.');
    }
}
