<?php layout() ?>

<style>
.checklist {
	font-size: var(--text-sm);
}
.checklist li {
	display: flex;
	align-items: center;
	gap: .5rem;
}
.checklist li + li {
	margin-top: .25rem;
}

.revenue {
	position: relative;
	font-size: var(--text-sm);
	margin-top: 1.25rem;
	margin-bottom: 3rem;
}
.revenue summary {
	background: var(--color-yellow-300);
	color: var(--color-yellow-900);
	border-radius: 2rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: .25rem .75rem;
	padding-right: .5rem;
}
.revenue summary::-webkit-details-marker {
	display: none;
}
.revenue summary svg {
	color: var(--color-yellow-700);
	margin-top: 1px;
}
.revenue div {
	position: absolute;
	top: 100%;
	left: 50%;
	width: 20rem;
	transform: translateX(-50%);
	background: black;
	color: white;
	margin-top: 1rem;
	padding: 1rem;
	border-radius: var(--rounded);
	box-shadow: var(--shadow-xl);
}
.revenue div::after {
	position: absolute;
	top: -4px;
	left: 50%;
	content: "";
	border-left: 4px solid transparent;
	border-bottom: 4px solid black;
	border-right: 4px solid transparent;
}
.revenue div p + p {
	margin-top: .75rem;
}
.revenue div strong {
	font-weight: var(--font-normal);
	color: var(--color-yellow-500);
}

.price {
	display: inline-flex;
	align-items: baseline;
	gap: 0.125rem;
}
.price[data-regular] {
	color: var(--color-gray-700);
	text-decoration: line-through;
}
.price[data-sale] {
	color: var(--color-purple-600);
}
.price[data-sale] .currency-sign {
	font-size: var(--text-xl);
}

[data-loading] .price[data-sale] {
	color: var(--color-gray-600)
}

@media (max-width: 40rem) {
	.causes li:not(:first-child) {
		display: none;
	}
}

.volume-toggles {
	display: flex;
	align-items: center;
	gap: 1.5rem;
}
.volume-toggles label {
	display: flex;
	align-items: center;
	gap: .5rem;
	cursor: pointer;
}

</style>

<article v-scope data-loading @mounted="mounted">
	<div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: var(--spacing-6)">

		<div>
			<h1 class="h1 max-w-xl mb-12">
				The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
			</h1>

			<?php if ($sale->isActive()): ?>
				<div class="h3 sale mb-6">
					<?= $sale->text() ?>
				</div>
			<?php endif ?>
		</div>

		<div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
			<div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>
						<?= $basic->label() ?>

						<?php if ($sale->isActive()): ?>
						<span class="price px-1" data-regular>
							<span v-text="currencySign">€</span>
							<span class="amount" v-text="amountDisplay(prices.basic.regular)"><?= $basic->price('EUR')->regular() ?></span>
						</span>
						<?php endif ?>
					</h2>

					<a href="/buy/basic" @click.prevent="openCheckout('basic')" target="_blank" class="h2 block mb-3">
						<span class="price" data-sale>
							<span class="currency-sign" v-text="currencySignTrimmed">€</span>
							<span class="amount" v-text="amountDisplay(prices.basic.sale)"><?= $basic->price('EUR')->sale() ?></span>
						</span>
						per site
					</a>

					<p class="text-sm color-gray-700">A discounted license for individuals, small teams and side projects</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>€1M / year</strong></span> <?= icon('info') ?></summary>
					<div>
						<p>Your revenue or funding is less than <strong>€1&nbsp;million<span v-if="revenueLimit.length" v-text="revenueLimit"></span></strong> in the <strong>last 12 months</strong>.</p>
						<p>If you build a website for a client, the limit has to fit the revenue of your client.</p>
					</div>
				</details>

				<?php snippet('templates/buy/checklist') ?>

				<footer>
					<p>
						<a href="/buy/basic" @click.prevent="openCheckout('basic')" target="_blank" class="btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy <?= $basic->label() ?>
						</a>
					</p>
				</footer>
			</div>

			<div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>
						<?= $enterprise->label() ?>

						<?php if ($sale->isActive()): ?>
						<span class="price px-1" data-regular>
							<span v-text="currencySign">€</span>
							<span class="amount" v-text="amountDisplay(prices.enterprise.regular)"><?= $enterprise->price('EUR')->regular() ?></span>
						</span>
						<?php endif ?>
					</h2>

					<a href="/buy/enterprise" @click.prevent="openCheckout('enterprise')" target="_blank" class="h2 block mb-3">
						<span class="price" data-sale>
							<span class="currency-sign" v-text="currencySignTrimmed">€</span>
							<span class="amount" v-text="amountDisplay(prices.enterprise.sale)"><?= $enterprise->price('EUR')->sale() ?></span>
						</span>
						per site
					</a>

					<p class="text-sm color-gray-700">Suitable for larger companies and organizations</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>No limit</strong></span> <?= icon('info') ?></summary>
					<div>
						This license does not have a revenue limit.
					</div>
				</details>

				<?php snippet('templates/buy/checklist') ?>

				<footer>
					<p>
						<a href="/buy/enterprise" @click.prevent="openCheckout('enterprise')" target="_blank" class="btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy <?= $enterprise->label() ?>
						</a>
					</p>
				</footer>
			</div>
			<p class="text-xs text-center mb-6 color-gray-700" style="--span: 2">Prices + VAT if applicable. With your purchase you agree to our <a class="underline" href="<?= url('license') ?>">License terms</a></p>
		</div>
	</div>

	<section class="mb-42">
		<form class="volume-discounts" method="POST" target="_blank" action="<?= url('buy/volume') ?>">
			<input type="hidden" name="donate">
			<header class="flex items-baseline justify-between mb-6">
				<h2 class="h2">Volume discounts</h2>
				<fieldset>
					<legend class="sr-only">License Type</legend>
					<div class="volume-toggles">
						<label><input type="radio" name="product" value="<?= $basic->value() ?>" v-model="license" checked> <?= $basic->label() ?></label>
						<label><input type="radio" name="product" value="<?= $enterprise->value() ?>" v-model="license"> <?= $enterprise->label() ?></label>
					</div>
				</fieldset>
			</header>
			<div class="columns rounded overflow-hidden" style="--columns-md: 3; --columns: 3; --gap: var(--spacing-3)">
				<?php foreach ($discounts as $volume => $discount) : ?>
					<div class="block p-12 bg-light rounded text-center" >
						<article>
							<h3 class="mb text-sm">
								<?= $volume ?>+ licenses
							</h3>
							<div class="mb-6">
								<p class="h2">
									Save <?= $discount ?>%
								</p>
								<?php if ($sale->isActive()): ?>
									<p class="sale text-sm">on top!</p>
								<?php endif ?>
							</div>

							<button class="btn btn--filled mb-3" @click.prevent="openCheckout(license, <?= $volume ?>)" name="volume" value="<?= $volume ?>">
								<?= icon('cart') ?> Buy now
							</button>
						</article>
					</div>
				<?php endforeach ?>
			</div>
		</form>
	</section>

	<section class="mb-42 columns columns--reverse" style="--columns: 2; --columns-md: 1; --gap: var(--spacing-36)">
		<div>

			<h2 class="h2 mb-6">For a good cause? <mark class="px-1 rounded">It’s free.</mark></h2>
			<div class="prose mb-6">
				<p>We care about a better society and the future of our planet. We support <strong>students, educational projects, social and environmental organizations, charities and non-profits</strong> with free&nbsp;licenses.</p>
			</div>

			<a class="btn btn--filled mb-12" href="mailto:support@getkirby.com">
				<?= icon('heart') ?>
				Contact us
			</a>

			<ul class="columns causes" style="--columns: 2; --gap: var(--spacing-12);">
				<?php foreach (collection('causes')->shuffle()->limit(2) as $case) : ?>
					<li>
						<a href="<?= $case->link()->toUrl() ?>">
							<figure>
								<span class="block shadow-2xl mb-3" style="--aspect-ratio: 3/4">
									<?= img($image = $case->image(), [
										'alt' => 'Screenshot of the ' . $image->alt() . ' website',
										'src' => [
											'width' => 300
										],
										'srcset' => [
											'1x' => 400,
											'2x' => 800,
										]
									]) ?>
								</span>
								<figcaption class="text-sm">
									<?= $case->title() ?>
								</figcaption>
							</figure>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>

		<div>
			<h2 class="h2 mb-6">Frequently asked questions</h2>
			<?php snippet('faq') ?>
		</div>
	</section>

	<footer class="h2">
		Manage your existing licenses in our <a href="https://hub.getkirby.com"><span class="link">license&nbsp;hub</span> &rarr;</a>
	</footer>

	<?php snippet('templates/buy/checkout') ?>

</article>

<script type="module">
import {
	createApp,
	reactive
} from '<?= url('assets/js/libraries/petite-vue.js') ?>';

// close price details on clicks outside the details
document.addEventListener("click", (event) => {
	for (const details of [...document.querySelectorAll("details")]) {
		if (details.contains(event.target) === false) {
			details.removeAttribute("open");
		}
	}
});

const checkout = document.querySelector(".checkout");

const zips = [
	"AU",
	"CA",
	"FR",
	"DE",
	"IN",
	"IT",
	"NL",
	"ES",
	"GB",
	"US"
];

createApp({
	amount(amount) {
		if (Number.isFinite(amount) === true) {
			const formatter = new Intl.NumberFormat("en", {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2,
			});
			return this.currencySignTrimmed + formatter.format(amount);
		}
	},
	amountDisplay(amount) {
		if (Number.isFinite(amount) === true) {
			const formatter = new Intl.NumberFormat("en");
			return formatter.format(amount);
		}
	},
	city: "",
	closeCheckout(event) {
		if (event.target === checkout) {
			checkout.close();
		}
	},
	company: "",
	country: "DE",
	currencySign: "€",
	currencySignTrimmed: "€",
	get discountRate() {
		if (this.quantity >= 15) {
			return 15;
		}

		if (this.quantity >= 10) {
			return 10;
		}

		if (this.quantity >= 5) {
			return 5;
		}

		return 0;
	},
	get discountAmount() {
		const factor = (100 - this.discountRate) / 100;
		return (this.netLicenseAmount - (this.netLicenseAmount * factor)) * -1;
	},
	donation: true,
	get donationAmount() {
		return this.donation ? (1 * this.quantity) : 0;
	},
	email: "",
	license: "basic",
	async mounted() {

		// fetch with options that allow using the preloaded response
		const response = await fetch("/buy/prices", {
			method: "GET",
			credentials: "include",
			mode: "no-cors",
		});

		const data = await response.json();

		this.currencySign        = data["currency-sign"];
		this.currencySignTrimmed = data["currency-sign-trimmed"];
		this.country             = data["country"];
		this.revenueLimit        = data["revenue-limit"];
		this.vatRate             = data["vat-rate"];

		// prices
		this.prices.basic.regular      = data["basic-regular"];
		this.prices.basic.sale         = data["basic-sale"];
		this.prices.enterprise.regular = data["enterprise-regular"];
		this.prices.enterprise.sale    = data["enterprise-sale"];

		document.querySelector("article[data-loading]").removeAttribute("data-loading");
	},
	get needsZip() {
		return zips.includes(this.country);
	},
	newsletter: false,
	get netLicenseAmount() {
		return this.price * this.quantity;
	},
	get netAmount() {
		return this.netLicenseAmount + this.donationAmount + this.discountAmount;
	},
	openCheckout(license, quantity = 1) {
		this.license = license;
		this.quantity = quantity;
		checkout.showModal();
	},
	get price() {
		return this.prices[this.license].sale;
	},
	prices: {
		basic: {
			regular: 99,
			sale: 99,
		},
		enterprise: {
			regular: 349,
			sale: 349,
		}
	},
	quantity: 1,
	revenueLimit: "",
	state: "",
	street: "",
	get totalAmount() {
		return this.netAmount + this.vatAmount;
	},
	get vatAmount() {
		const rate = this.vatIdExists ? 0 : this.vatRate;
		return (this.netAmount / 100) * rate;
	},
	vatRate: 0,
	vatId: "",
	get vatIdExists() {
		return Boolean(this.vatId?.length);
	},
	zip: "",
}).mount();
</script>
