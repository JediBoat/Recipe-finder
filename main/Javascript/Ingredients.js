class Ingredient {
    constructor(quantity) {
        this.quantity = quantity; // numeric value only
        this.unit = '';           // defined in sub classes
    }

    getFormattedQuantity() {
        return `${this.quantity}${this.unit}`;
    }
}

class SolidIngredient extends Ingredient {
    constructor(quantity) {
        super(quantity);
        this.unit = 'g'; // grams
    }
}

class LiquidIngredient extends Ingredient {
    constructor(quantity) {
        super(quantity);
        this.unit = 'ml'; // milliliters
    }
}

class CountableIngredient extends Ingredient { // eggs
    constructor(quantity) {
        super(quantity);
        this.unit = 'pcs'; // pieces
    }
}

module.exports = { // so that you can use code from this file in another file in js (using it server.js)
    SolidIngredient,
    LiquidIngredient,
    CountableIngredient
};