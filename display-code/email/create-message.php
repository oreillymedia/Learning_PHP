$message = Swift_Message::newInstance();
$message->setFrom('julia@example.com');
$message->setTo(array('james@example.com' => 'James Beard'));
$message->setSubject('Delicious New Recipe');
$message->setBody(<<<_TEXT_
Dear James,

You should try this: puree 1 pound of chicken with two pounds
of asparagus in the blender, then drop small balls of the mixture
into a deep fryer. Yummy!

Love,
Julia

_TEXT_
);