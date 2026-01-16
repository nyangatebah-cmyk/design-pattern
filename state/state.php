<?php
// Define a common interface for all states
interface State {
    public function handle(Context $context);
}

// Concrete State A
class StateA implements State {
    public function handle(Context $context) {
        echo "StateA: Handling request and changing state to StateB.
";
        $context->setState(new StateB());
    }
}

// Concrete State B
class StateB implements State {
    public function handle(Context $context) {
        echo "StateB: Handling request and changing state to StateA.
";
        $context->setState(new StateA());
    }
}

// Context class that maintains a reference to the current state
class Context {
    private State $state;

    public function __construct(State $state) {
        $this->state = $state;
    }

    // Method to set a new state
    public function setState(State $state): void {
        $this->state = $state;
    }

    // Method to trigger state-specific behavior
    public function request(): void {
        $this->state->handle($this);
    }
}

// Usage Example
$context = new Context(new StateA());

$context->request(); // StateA handles request -> changes to StateB
$context->request(); // StateB handles request -> changes back to StateA
$context->request(); // StateA handles request -> changes to StateB