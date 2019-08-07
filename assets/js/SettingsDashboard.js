import React, {Component} from 'react';
import Locations from './Locations';
import AddLocationForm from "./AddLocationForm";
import axios from "axios/index";
import Styles from "./Styles";
import AddStyleForm from "./AddStyleForm";

export default class SettingsDashboard extends Component {

    constructor(props) {
        super(props);
        this.state = {
            locationList: {},
            styleList: {}
        };

        this.onNewLocationSubmit = this.onNewLocationSubmit.bind(this);
        this.onRemoveLocation = this.onRemoveLocation.bind(this);
        this.onNewStyleSubmit = this.onNewStyleSubmit.bind(this);
        this.onRemoveStyle = this.onRemoveStyle.bind(this);

    }

    componentDidMount() {
        this.getLocationData();
        this.getStyleData();
    }

    getLocationData() {
        axios.get('/location/list.json').then(response => {
            this.setState({locationList: response})
        })
    }

    getStyleData() {
        axios.get('/style/list.json').then(response => {
            this.setState({styleList: response})
        })
    }

    onNewLocationSubmit(room, container, shelf) {
        axios.post('/api/commands/add-location', JSON.stringify({
            'room' : room,
            'container': container,
            'shelf' : shelf
        }));
        this.getLocationData();
    }

    onNewStyleSubmit(name) {
        axios.post('/api/commands/add-style', JSON.stringify({
            'name' : name
        }));
        this.getStyleData();
    }

    onRemoveLocation(id) {
        axios.post('/api/commands/remove-location', JSON.stringify({
            'id' : id
        }));
        this.getLocationData();
    }

    onRemoveStyle(id) {
        axios.post('/api/commands/remove-style', JSON.stringify({
            'id' : id
        }));
        this.getStyleData();
    }

    render() {
        const { locationList, styleList } = this.state;
        return (<div className="row">
            <div className="col-lg-6">
                <div className="row">
                    <div className="col-lg-8 order-first order-lg-first order-sm-last">
                        <Locations
                            locationList={locationList}
                            onDelete={this.onRemoveLocation}
                        />
                    </div>
                    <div className="col-lg-4 order-last order-lg-last order-sm-first">
                        <AddLocationForm
                            onNewLocationSubmit={this.onNewLocationSubmit}
                        />
                    </div>
                </div>
            </div>
            <div className="col-lg-6">
                <div className="row">
                    <div className="col-lg-8 order-first order-lg-first order-sm-last">
                        <Styles
                            styleList={styleList}
                            onDelete={this.onRemoveStyle}
                        />
                    </div>
                    <div className="col-lg-4 order-last order-lg-last order-sm-first">
                        <AddStyleForm
                            onNewStyleSubmit={this.onNewStyleSubmit}
                        />
                    </div>
                </div>
            </div>
        </div>)
    }
}