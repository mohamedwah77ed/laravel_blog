<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;


class UserPostController extends Controller
{
    public function show()
{
    $posts = Post::where('user_id', auth()->id())->get();
    return view('user.posts', compact('posts'));
}

   
    public function show_post(post $post)
    {
        $comments = $post->comments()->with('user')->get();// يستدعي العلاقة بين المنشور (Post) والتعليقات (Comments) باستخدام Eloquent Relationship.
        //$comments = $post->comments()->latest()->take(5)->get(); عرض 5 تعليقات فقط
        
        return view('user.show_post', compact('post', 'comments'));//compact هي دالة في PHP تأخذ أسماء المتغيرات كسلاسل نصية ('post', 'comments') وتُرجع مصفوفة تحتوي على هذه المتغيرات وقيمها.
        
        //compact('post', 'comments') يمرر بيانات المقال والتعليقات للعرض.
        //['post' => $post, 'comments' => $comments]
        
        }

public function create()
{
    $users = User::all();
    return view('user.create');

}

public function store(Request $request)
{
    // ✅ التحقق من صحة البيانات بدون 'author'
    $request->validate([
        'title' => ['required', 'min:3'],
        'content' => ['required', 'min:5'],
    ]);

    // ✅ إنشاء البوست وتعيين الكاتب تلقائيًا
    $post = Post::create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'user_id' => auth()->id(), // ✅ استخدام المستخدم المسجل حاليًا
    ]);

    // ✅ استخراج الهاشتاجات من المحتوى
    preg_match_all('/#(\w+)/u', $request->input('content'), $matches);
    $hashtags = $matches[1];

    if (!empty($hashtags)) {
        $hashtagIds = [];

        foreach ($hashtags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                $hashtag = Hashtag::firstOrCreate(['name' => $tagName]);
                $hashtagIds[] = $hashtag->id;
            }
        }

        // ✅ ربط الهاشتاجات بالبوست
        $post->hashtags()->sync($hashtagIds);
    }

    return to_route('dashboard');
}

public function edit(Post $post)
{
    return view('user.edit_post', compact('post'));
}

    public function update($id)
    {
        $request = request();
       // dd($request->all());
       // $data = $request->all();
        $title = request()->title;
        $content = request()->content;
       // $author = request()->author;
        //dd($title, $content, $author);

        //return $data;

         //2- update the submitted data in database
            //select or find the post
            //update the post data
        $singlePostFromDB = Post::find($id);
        $singlePostFromDB->update([
            'title' => $title,
            'content' => $content,
           // 'author' => $postCreator,
        ]);
        preg_match_all('/#(\w+)/u', $request->input('content'), $matches);
        $hashtags = $matches[1]; // تحتوي على أسماء الهاشتاجات بدون #

        if (!empty($hashtags)) {
            $hashtagIds = [];

            foreach ($hashtags as $tagName) {
                //// إزالة أي مسافات زائدة
                $tagName = trim($tagName);
                if (!empty($tagName)) {
                    // البحث عن الهاشتاج لومش موجوديتم انشاؤالطريقة دي بتققل من استخدام لذاكرة
                    $hashtag = Hashtag::firstOrCreate(['name' => $tagName]);
                    $hashtagIds[] = $hashtag->id;
                }
            }

            // ربط الهاشتاجات بالبوست يعني هشتاج 1و2و3  مربوط ببوست 1
            $post->hashtags()->sync($hashtagIds);
        }
        return to_route('myposts.show', $id);

    }
    public function destroy($id)
    {
        $post = Post::find($id);
       // dd($post);
        $post->delete();
        return to_route('myposts.show');

    }


}
