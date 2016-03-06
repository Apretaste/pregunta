<h1>Top 10 Questions</h1>

{space10}

<ol>
{foreach from=$items item=item}
  <li><p><strong>{$item->title}</strong><br/>
      {$item->user->username}&nbsp;&nbsp;
      {$item->created_at|date_format:"%b %e, %Y"}&nbsp;&nbsp;
      {$item->upvotes_count} votes</p>
      {button href="PREGUNTA SHOW {$item->id}" caption="Expand" size="small"}
      {button href="PREGUNTA ANSWER {$item->id}" caption="Answer" size="small"}
  </li>
{/foreach}
</ol>
{space15}
{space15}
