<?php
function cleanPhotoUrl($fotoUrl, $pdo, $personaId)
{
  if (strpos($fotoUrl, 'Genealorico/fotos/') !== false) {
    $newFotoUrl = str_replace('Genealorico/fotos/', '', $fotoUrl);

    $updateQuery = "UPDATE Personas SET Foto = :nuevaFoto WHERE PersonaID = :id";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([
      ':nuevaFoto' => $newFotoUrl,
      ':id' => $personaId
    ]);

    return $newFotoUrl;
  }

  return $fotoUrl;
}
