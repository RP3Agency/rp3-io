<!-- Underscore Templates -->

<script type="text/template" id="blog-template">
<% _.each( posts, function( post ) { %>

	<article class="single-blog">

		<div class="single-blog__wrapper">

			<header class="single-blog__header">

				<h1 class="single-blog__title"><%= post.get( 'title' ) %></h1>

				<div class="single-blog__date"><%= post.get( 'date' ) %></div>

			</header>

			<section class="single-blog__featured-image">

				<picture>
					<source srcset="<%= post.get( 'eight_three_large' ) %>, <%= post.get( 'eight_three_large_2x' ) %> 2x" media="(min-width: 37.5rem)" />
					<source srcset="<%= post.get( 'four_three_medium' ) %>, <%= post.get( 'four_three_medium_2x' ) %> 2x" media="(min-width: 20.0625rem)" />
					<source srcset="<%= post.get( 'four_three_small' ) %>, <%= post.get( 'four_three_small_2x' ) %> 2x" />
					<img srcset="<%= post.get( 'four_three_small' ) %>, <%= post.get( 'four_three_small_2x' ) %> 2x" />
				</picture>

			</section>

			<section class="single-blog__content">

				<%= post.get( 'content' ) %>

			</section>

			<?php /*
			<section class="blog__author">

				<header class="blog__author__header">

					<div class="blog__author__meta">

						<div class="blog__author__image">

							<img srcset="">

						</div>
						<!-- // blog author image -->

					</div>
					<!-- // blog author meta -->

				</header>
				<!-- // blog author header -->

				<div class="blog__author__bio">

					<p><a href="#!"><%= post.get( 'author' ).name %></a> <%= post.get( 'author' ).description %></p>

				</div>

			</section>
			*/ ?>

		</div>

	</article>

<% }) %>
</script>


<?php /*
<script type="text/template" id="blog-template-author">
<% _.each( authors, function( author ) { %>

	<section class="blog__author">

		<header class="blog__author__header">

			<div class="blog__author__meta">

				<div class="blog__author__image">

					<img srcset="">

				</div>
				<!-- // blog author image -->

			</div>
			<!-- // blog author meta -->

		</header>
		<!-- // blog author header -->

		<div class="blog__author__bio">

			<p><a href="#!"><%= author.name %></a></p>

		</div>

	</section>

<% }) %>
</script>
*/ ?>


<script type="text/template" id="blog-template-interstitial">

<?php get_template_part( 'template-parts/component', 'blog-interstitial' ); ?>

</script>