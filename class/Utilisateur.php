<?php
class Utilisateur {
    private $id;
    private $email;
    private $motDePasse;
    private $role;
    private $resetToken;
    private $resetTokenExpiry;
    private $verification_code;
    private $is_verified;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getResetToken() {
        return $this->resetToken;
    }

    public function setResetToken($resetToken) {
        $this->resetToken = $resetToken;
    }

    public function getResetTokenExpiry() {
        return $this->resetTokenExpiry;
    }

    public function setResetTokenExpiry($resetTokenExpiry) {
        $this->resetTokenExpiry = $resetTokenExpiry;
    }

    public function getVerificationCode() {
        return $this->verification_code;
    }

    public function setVerificationCode($verification_code) {
        $this->verification_code = $verification_code;
    }

    public function getIsVerified() {
        return $this->is_verified;
    }

    public function setIsVerified($is_verified) {
        $this->is_verified = $is_verified;
    }
}
?>
