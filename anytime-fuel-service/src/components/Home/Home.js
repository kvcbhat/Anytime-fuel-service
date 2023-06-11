import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import Home2 from "./Home2";
import Particle from "../Particle";

function Home() {
  return (
    <section>
      <Container fluid className="home-section" id="home">
        <Particle />
        <Container className="home-content">
          <Row>

          </Row>
        </Container>
      </Container>
      <Home2 />
    </section>
  );
}

export default Home;
