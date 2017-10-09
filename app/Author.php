<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    public $table = "author";
    public $primaryKey = "author_id";

    /**
     * Get the books associated with this author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_author',
                                    'author_id', 'book_id');
    }

    /**
     * Get the user associated with this author
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user()
    {
        return $this->hasOne('App\User', 'user_id');
    }

    /**
     * Get the royalty recipient associated with this author
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function royaltyRecipient()
    {
        return $this->belongsToMany('App\RoyaltyRecipient',
            'royalty_recipient_author',
            'author_id',
            'royalty_recipient_id');
    }

    /**
     * Determine if this author receives royalties of a given book
     *
     * @param int $book_id
     * @return boolean
     */
    public function hasRoyaltyOfBook($book_id)
    {
        foreach ($this->royaltyRecipient as $royaltyRecipient) {
            if ($royaltyRecipient->hasAgreementOfBook($book_id)) {
                return true;
            }
        }
        
        return false;
    }
}
