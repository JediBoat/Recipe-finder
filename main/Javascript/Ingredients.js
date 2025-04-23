class Ingredient {
    constructor(name, quantity) {
        this.name = name;
        this.quantity = quantity;
        this.unit = ''; // Default to no unit of measure
    }
}

class SolidIngredient extends Ingredient {
    constructor(name, quantity) {
        super(name, quantity);
        this.unit = 'g';
    }
}

class LiquidIngredient extends Ingredient {
    constructor(name, quantity) {
        super(name, quantity);
        this.unit = 'ml';
    }
}

class CountableIngredient extends Ingredient {
    constructor(name, quantity) {
        super(name, quantity);
        this.unit = 'pcs';
    }
}

// allows for the classes to be used in different files
module.exports = {
    SolidIngredient,
    LiquidIngredient,
    CountableIngredient
};