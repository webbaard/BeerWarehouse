export default class Beer {
    readonly name: string;
    readonly brewer: string;
    readonly style: string;

    constructor (name: string, brewer: string, style: string) {
        this.name = name;
        this.brewer = brewer;
        this.style = style;
    }
}