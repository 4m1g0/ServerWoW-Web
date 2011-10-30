// WoWCS Store Client Handler
var Store = {
	_action: '',
	_item: 0,
	_cat: 0,
	_cart: [],
	_xstoken: '',
	_data: '',
	_correct: false,
	init: function(xstoken) {
		if (this._xstoken != '')
			return false;

		this._xstoken = xstoken;
		this._action = '';
		this._item = 0;
		this._cat = 0;
		this._cart = [];

		this._correct = true;

		return true;
	},
	isCorrect: function() {
		if (!this._correct)
		{
			document.location.href = '/';
			return false;
		}
		else
			return true;
	},
	addToCart: function(item, cat, xstoken) {
		if (!this.isCorrect())
			return this;
		if (!item || !cat || !xstoken)
			return document.location.href = '/';

		var item_data = {itemId: item, categoryId: cat, userSeed: xstoken};
		this._cart.push(item_data);
		var quant = $('#item-' + item + '-quantity').val();
		if (!quant || quant <= 0)
			quant = 1;
		else if (quant > 1000)
			quant = 1000;

		this.setAction('add2cart')
			.setData('item', item)
			.setData('category', cat)
			.setData('seed', xstoken)
			.setData('quantity', quant)
			.performAction();

		return this;
	},
	removeFromCart: function(item, xstoken) {
		if (!this.isCorrect())
			return this;
		for(var i in this._cart) {
			if (i.itemId == item && i.xstoken == xstoken)
				delete i;
		}

		this.setAction('removefromcart')
			.setData('item', item)
			.setData('seed', xstoken)
			.performAction();
		return this;
	},
	setAction: function(act) {
		if (!this.isCorrect())
			return this;
		this._action = act;

		return this;
	},
	getAction: function() {
		if (!this.isCorrect())
			return this;
		return this._action;
	},
	setData: function (idx, val) {
		if (!this.isCorrect())
			return this;
		if (this._data != '')
			this._data += '&';

		this._data += idx + '=' + val;

		return this;
	},
	getData: function() {
		if (!this.isCorrect())
			return this;
		return this._data;
	},
	performAction: function() {
		if (!this.isCorrect())
			return this;
		$.ajax({
			'url': Core.baseUrl + '/store/api/' + this.getAction(),
			'type': 'POST',
			'data-type': 'JSON',
			'data': {'store': this.getData()},
			success: function(res) {
				Store.handleResult($.parseJSON(res));
			}
		});

		this.postAction();

		return this;
	},
	postAction: function() {
		if (!this.isCorrect())
			return this;
		this._data = '';
		this._action = '';
	},
	handleResult: function(res) {
		if (!this.isCorrect())
			return this;
		switch (res.method)
		{
			case 'add2cart':
				if (res.err == 'none' && res.success)
				{
					$('#op-result-' + res.id).text('This item was added to your cart!').show();
					$('#add2cart-link-' + res.id).hide();
					$('#removefromcart-link-' + res.id).show();
				}
				break;
			case 'removefromcart':
				if (res.err == 'none' && res.success)
				{
					$('#op-result-' + res.id).text('This item was removed from your cart!').show();
					$('#removefromcart-link-' + res.id).hide();
					$('#add2cart-link-' + res.id).show();
				}
				break;
		}

		return this;
	}
};