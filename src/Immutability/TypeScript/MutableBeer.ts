class Beer {
    private brewer: string;
    private name: string;
    private style: string;
    constructor (name, brewer, style) {
        this.name = name;
        this.brewer = brewer;
        this.style = style
    }
}
var beer = new Beer('KBS', 'Founders', 'Russian Imperial Stout');
beer.name = 'Not KBS';