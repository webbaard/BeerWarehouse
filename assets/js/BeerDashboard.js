import React, {Component} from 'react';
import Beers from './Beers';
import BeerDetails from './BeerDetails';
import AddBeerForm from "./AddBeerForm";
import axios from "axios/index";

export default class BeerDashboard extends Component {

    constructor(props) {
        super(props);
        this.state = {
            beerList: {},
            beerDetails: {},
            styleOptions: {},
            locationOptions: {},
        };

        this.onSelection = this.onSelection.bind(this);
        this.onNewBeerSubmit = this.onNewBeerSubmit.bind(this);
        this.onConsumeBeer = this.onConsumeBeer.bind(this);
        this.onRemoveBeer = this.onRemoveBeer.bind(this);
        this.onMoveBeer = this.onMoveBeer.bind(this);
    }

    componentDidMount() {
        this.getBeerData();
        this.getLocationOptions();
        this.getStyleOptions();
    }

    getBeerData() {
        axios.get('/beer/list.json').then(response => {
            this.setState({beerList: response})
        })
    }

    getLocationOptions() {
        axios.get('/location/list.json').then(response => {
            this.setState({locationOptions: response})
        })
    }

    getStyleOptions() {
        axios.get('/style/list.json').then(response => {
            this.setState({styleOptions: response})
        })
    }

    onSelection(id) {
        if (id === "") {
            return;
        }
        axios.get('/beer/' + id + '.json').then(response => {
            this.setState({beerDetails: response})
        })
    }

    onNewBeerSubmit(brewer, name, shop, style, location) {
        axios.post('/api/commands/buy-beer', JSON.stringify({
            'brewer': brewer,
            'name' : name,
            'shop' : shop,
            'style' : style,
            'location' : location
        }));
        this.getBeerData();
    }

    onConsumeBeer(id) {
        axios.post('/api/commands/consume-beer', JSON.stringify({
            'id' : id
        }));
        this.getBeerData();
    }

    onRemoveBeer(id) {
        axios.post('/api/commands/remove-beer', JSON.stringify({
            'id' : id
        }));
        this.getBeerData();
    }

    onMoveBeer(id, location) {
        axios.post('/api/commands/move-beer', JSON.stringify({
            'id' : id,
            'location' : location
        }));
        this.onSelection(id);
    }

    render() {
        const { beerList, beerDetails, styleOptions, locationOptions } = this.state;
        return (<div className="row">
            <div className="col-lg-5 order-first order-lg-first order-sm-last">
                <Beers
                    beerList={beerList}
                    onSelection={this.onSelection}
                />
            </div>
            <div className="col-lg-4">
                <BeerDetails
                    beerDetails={beerDetails}
                    onConsumeBeer={this.onConsumeBeer}
                    onRemoveBeer={this.onRemoveBeer}
                    onMoveBeer={this.onMoveBeer}
                />
            </div>
            <div className="col-lg-3 order-last order-lg-last order-sm-first">
                <AddBeerForm
                    onNewBeerSubmit={this.onNewBeerSubmit}
                    styleOptions={styleOptions}
                    locationOptions={locationOptions}
                />
            </div>
        </div>)
    }
}