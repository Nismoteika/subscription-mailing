<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DB;

class SpreadArticles extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The article instance.
     *
     * @var \App\Models\Article
     */
    public $articles;
    public $rubrics;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rubrics)
    {
        $arrRubricsIds = [];
        foreach($rubrics as $rubric) {
            array_push($arrRubricsIds, $rubric->id);
        }

        $articles = DB::table('articles')
            ->join('rubrics', 'rubrics.id', '=', 'articles.rubric_id')
            ->whereIn('rubric_id', $arrRubricsIds)
            ->select('articles.id', 'articles.title as article_title', 
                    'articles.text', 'rubrics.title as rubric_title')
            ->take(5)
            ->get();

        $this->rubrics = $rubrics;
        $this->articles = $articles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.spread-article');
    }
}
