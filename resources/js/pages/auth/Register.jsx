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
    Select,
    Grid,
} from '@chakra-ui/react';
import { Link as RouterLink, useNavigate } from 'react-router-dom';

const Register = () => {
    const [formData, setFormData] = useState({
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
        role: 'agency_admin',
    });
    const [loading, setLoading] = useState(false);

    const navigate = useNavigate();
    const bgColor = useColorModeValue('white', 'gray.800');

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);

        // Demo registration - replace with actual API call
        setTimeout(() => {
            navigate('/login');
        }, 1000);
    };

    return (
        <Box bg={bgColor} p={8} borderRadius="xl" shadow="lg">
            <Stack spacing={6}>
                <Box textAlign="center">
                    <Heading size="lg" mb={2}>
                        Create your account
                    </Heading>
                    <Text color="gray.600">
                        Get started with Real Estate SaaS
                    </Text>
                </Box>

                <form onSubmit={handleSubmit}>
                    <Stack spacing={4}>
                        <Grid templateColumns="repeat(2, 1fr)" gap={4}>
                            <FormControl isRequired>
                                <FormLabel>First Name</FormLabel>
                                <Input
                                    name="first_name"
                                    value={formData.first_name}
                                    onChange={handleChange}
                                    placeholder="John"
                                />
                            </FormControl>

                            <FormControl isRequired>
                                <FormLabel>Last Name</FormLabel>
                                <Input
                                    name="last_name"
                                    value={formData.last_name}
                                    onChange={handleChange}
                                    placeholder="Doe"
                                />
                            </FormControl>
                        </Grid>

                        <FormControl isRequired>
                            <FormLabel>Email address</FormLabel>
                            <Input
                                type="email"
                                name="email"
                                value={formData.email}
                                onChange={handleChange}
                                placeholder="you@example.com"
                            />
                        </FormControl>

                        <FormControl>
                            <FormLabel>Phone</FormLabel>
                            <Input
                                name="phone"
                                value={formData.phone}
                                onChange={handleChange}
                                placeholder="+234 800 000 0000"
                            />
                        </FormControl>

                        <FormControl isRequired>
                            <FormLabel>Account Type</FormLabel>
                            <Select name="role" value={formData.role} onChange={handleChange}>
                                <option value="agency_admin">Agency</option>
                                <option value="client">Client</option>
                            </Select>
                        </FormControl>

                        <FormControl isRequired>
                            <FormLabel>Password</FormLabel>
                            <Input
                                type="password"
                                name="password"
                                value={formData.password}
                                onChange={handleChange}
                                placeholder="••••••••"
                            />
                        </FormControl>

                        <FormControl isRequired>
                            <FormLabel>Confirm Password</FormLabel>
                            <Input
                                type="password"
                                name="password_confirmation"
                                value={formData.password_confirmation}
                                onChange={handleChange}
                                placeholder="••••••••"
                            />
                        </FormControl>

                        <Button
                            type="submit"
                            colorScheme="brand"
                            size="lg"
                            isLoading={loading}
                        >
                            Create Account
                        </Button>
                    </Stack>
                </form>

                <Text fontSize="sm" textAlign="center">
                    Already have an account?{' '}
                    <Link as={RouterLink} to="/login" color="brand.600" fontWeight="semibold">
                        Sign in
                    </Link>
                </Text>
            </Stack>
        </Box>
    );
};

export default Register;
