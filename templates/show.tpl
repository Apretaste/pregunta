
<h1>Question:</h1>
<p>{$item->title}</p>

{space10}

<h2>Answers:</h2>

<ol>
{foreach from=$item->comments item=comment}
  <li><p><strong>{$comment->content}</strong></p>
      {$comment->user->username}&nbsp;&nbsp;
      {$comment->created_at|date_format:"%b %e, %Y"}
  </li>
{/foreach}
</ol>
{space15}
{space15}
