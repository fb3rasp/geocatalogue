	<div id="PageNumbers">
		<p class="buttonLinks">
			<% if IsFirstResultPage %>
				<span class="prevLink">Previous</span>
			<% else %>
				<a href="$Link/giveresult/$PrevStart/$searchTerm/" class="prevLink">Previous</a>
			<% end_if %>
			<% if IsLastResultPage %>
				<span class="nextLink">Last</span>
			<% end_if %>	
		</p>
		<p>Page $onpage of $ofpages</p>
	</div>
