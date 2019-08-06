import React, { Component } from 'react';
import { render} from 'react-dom';
import logo from '../media/beer.svg';
import '../css/App.css';
import { BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import BeerDashboard from "./BeerDashboard";
import SettingsDashboard from "./SettingsDashboard";

class App extends Component {
    render() {
        return (
            <Router basename={process.env.PUBLIC_URL}>
                <div className="App">
                    <header className="App-header">
                        <img src={logo} className="App-logo" alt="logo" />
                        <h1 className="App-title">Beer list</h1>
                        <a href="/">Dashboard</a>
                        <a href="/settings">Settings</a>
                    </header>
                    <Switch>
                        <Route exact path='/' component={BeerDashboard} />
                        <Route exact path='/settings' component={SettingsDashboard} />
                    </Switch>
                </div>
            </Router>
        );
    }
}

render(<App />, document.getElementById('root'));