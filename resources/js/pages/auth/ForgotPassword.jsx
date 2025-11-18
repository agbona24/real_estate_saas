import React, { useState } from 'react';
import {
    Box,
    Button,
    FormControl,
    FormLabel,
    Input,
    Stack,
    Text,
    Heading,
    Link,
    useColorModeValue,
    Alert,
    AlertIcon,
} from '@chakra-ui/react';
import { Link as RouterLink } from 'react-router-dom';

const ForgotPassword = () => {
    const [email, setEmail] = useState('');
    const [loading, setLoading] = useState(false);
    const [success, setSuccess] = useState(false);

    const bgColor = useColorModeValue('white', 'gray.800');

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);

        // Demo - replace with actual API call
        setTimeout(() => {
            setSuccess(true);
            setLoading(false);
        }, 1000);
    };

    return (
        <Box bg={bgColor} p={8} borderRadius="xl" shadow="lg">
            <Stack spacing={6}>
                <Box textAlign="center">
                    <Heading size="lg" mb={2}>
                        Forgot your password?
                    </Heading>
                    <Text color="gray.600">
                        Enter your email and we'll send you a reset link
                    </Text>
                </Box>

                {success ? (
                    <Alert status="success" borderRadius="md">
                        <AlertIcon />
                        Password reset link sent! Check your email.
                    </Alert>
                ) : (
                    <form onSubmit={handleSubmit}>
                        <Stack spacing={4}>
                            <FormControl isRequired>
                                <FormLabel>Email address</FormLabel>
                                <Input
                                    type="email"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    placeholder="you@example.com"
                                />
                            </FormControl>

                            <Button
                                type="submit"
                                colorScheme="brand"
                                size="lg"
                                isLoading={loading}
                            >
                                Send Reset Link
                            </Button>
                        </Stack>
                    </form>
                )}

                <Text fontSize="sm" textAlign="center">
                    <Link as={RouterLink} to="/login" color="brand.600">
                        ← Back to Sign in
                    </Link>
                </Text>
            </Stack>
        </Box>
    );
};

export default ForgotPassword;
